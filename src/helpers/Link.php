<?php
require_once 'Database.php';

class Link
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllLink()
    {
        $links = array();
        $conn = $this->db->conn;
        $result = $conn->query("SELECT * FROM link");
        while ($row = $result->fetch_assoc()) {
            $links[] = $row;
        }
        return $links;
    }

    public function getLinkById($linkId)
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM links WHERE id = ?");
        $stmt->bind_param("i", $linkId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateLink($linkId, $name, $url)
    {
        $stmt = $this->db->conn->prepare("UPDATE links SET name = ?, url = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $url, $linkId);
        return $stmt->execute();
    }

    public function createLink($name, $url)
    {

        $stmt = $this->db->conn->prepare("INSERT INTO links (name, url) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $url);
        return $stmt->execute();
    }

    public function deleteLink($linkId)
    {
        $stmt = $this->db->conn->prepare("DELETE FROM links WHERE id = ?");
        $stmt->bind_param("i", $linkId);
        return $stmt->execute();
    }
}
