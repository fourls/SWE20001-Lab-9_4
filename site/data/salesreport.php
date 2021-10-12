<?php

const SALES_REPORT_MONTHLY = 1;
const SALES_REPORT_WEEKLY = 2;

class SalesRecord {
    public int $sale_id;
    public int $product_id;
    public string $product_name;
    public int $sale_quantity;
    public DateTime $sale_date;

    function __construct(int $sale_id, int $product_id, string $product_name, int $sale_quantity, DateTime $sale_date) {
        $this->sale_id = $sale_id;
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->sale_quantity = $sale_quantity;
        $this->sale_date = $sale_date;
    }
}

class SalesReport {
    // The title of the report.
    public string $report_name;
    // The start date of the range the report is reporting on.
    public DateTime $start_date;
    // The sales records listed in the time period the report is reporting on.
    public array $sales_records;
    // The type of report: 1 = monthly, 2 = weekly
    public int $report_type;
    // An error message (leave empty to not have an error.)
    public string $message;
    
    // Generate a sales report from a MySQL connection $conn
    static function generate(mysqli $conn, string $report_name, DateTime $start_date, int $report_type): SalesReport|null {
        // create empty sales report object
        $report = new SalesReport();
        $report->report_name = $report_name;
        $report->start_date = $start_date;
        $report->report_type = $report_type;
        $report->sales_records = [];
        
        // if there's an issue with the database, return an empty report with an error message in it
        if(!$conn) {
            $report->message = "Could not connect to database";
            return $report;
        }
        
        $sql_interval;
        // if the sales report should be a monthly report, set the SQL query to have "1 MONTH" in it
        if($report_type == SALES_REPORT_MONTHLY) {
            $sql_interval = "1 MONTH";
        // otherwise, set the SQL query to have "1 WEEK" in it
        } else if ($report_type == SALES_REPORT_WEEKLY) {
            $sql_interval = "1 WEEK";
        // if it's not weekly or monthly for some weird reason, return an empty report with an error message in it
        } else {
            $report->message = "Invalid time interval given";
            return $report;
        }
        
        // format the date as Y-m-d (e.g. 2021-02-23)
        $date_str = $start_date->format("Y-m-d");
        
        // prepare an SQL statement (https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php)
        $stmt = $conn->prepare("SELECT sale_id, product_name, product_id, sale_quantity, sale_date from sales_record NATURAL JOIN product WHERE sale_date BETWEEN ? AND DATE_ADD(?, INTERVAL ".$sql_interval.") ORDER BY sale_date ASC");
        // replace the '?'s in the SQL statement with the formatted date
        $stmt->bind_param("ss", $date_str, $date_str);
        // execute the statement
        $stmt->execute();
        // get the returned rows
        $result = $stmt->get_result();
        
        // create a new SalesRecord object for each database row
        while ($row = $result->fetch_assoc()) {
            $report->sales_records[] = new SalesRecord(
                $row["sale_id"], 
                $row["product_id"], 
                $row["product_name"], 
                $row["sale_quantity"], 
                new DateTime($row["sale_date"])
            );
        }

        // clean up the DB objects
        $result->free();
        $conn->close();

        // return the complete report
        return $report;
    }
}