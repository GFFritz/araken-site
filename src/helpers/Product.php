<?php
// Product.php

require_once 'Database.php';

class Product
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function updateProduct($productId, $url)
  {
    $stmt = $this->db->conn->prepare("UPDATE imagens SET url = ? WHERE id = ?");
    $stmt->bind_param("si", $url, $productId);
    return $stmt->execute();
  }
}
