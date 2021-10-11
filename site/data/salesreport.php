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
    public string $report_name;
    public DateTime $start_date;
    public array $sales_records;
    public int $report_type;
    public string $message;
    
    static function generate(mysqli $conn, string $report_name, DateTime $start_date, int $report_type): SalesReport|null {
        $report = new SalesReport();
        $report->report_name = $report_name;
        $report->start_date = $start_date;
        $report->report_type = $report_type;
        $report->sales_records = [];

        if(!$conn) {
            $report->message = "Could not connect to database";
            return $report;
        }
        
        $sql_interval;
        if($report_type == SALES_REPORT_MONTHLY) {
            $sql_interval = "1 MONTH";
        } else if ($report_type == SALES_REPORT_WEEKLY) {
            $sql_interval = "1 WEEK";
        } else {
            $report->message = "Invalid time interval given";
            return $report;
        }
        
        $stmt = $conn->prepare("SELECT sale_id, product_name, product_id, sale_quantity, sale_date from sales_record NATURAL JOIN product WHERE sale_date BETWEEN ? AND DATE_ADD(?, INTERVAL ".$sql_interval.") ORDER BY sale_date ASC");
        $stmt->bind_param("ss", $start_date->format("Y-m-d"), $end_date->format("Y-m-d"));
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $report->sales_records[] = new SalesRecord(
                $row["sale_id"], 
                $row["product_name"], 
                $row["product_id"], 
                $row["sale_quantity"], 
                $row["sale_date"],
                new DateTime($row["sale_date"])
            );
        }
        $result->free();
        $conn->close();

        return $report;
    }
}