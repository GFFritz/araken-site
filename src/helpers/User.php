<?php
require_once 'Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password)
    {
        $stmt = $this->db->conn->prepare("SELECT id, username, password, access_level FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] === md5($password)) {
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['access_level'] = $row['access_level'];

                // Redireciona com base no nível de acesso
                header("Location: index.php");
                exit;
                // Adicione outras verificações de nível de acesso conforme necessário

                return true;
            }
        }
        return false;
    }

    public function register($username, $password)
    {
        $stmt = $this->db->conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return false;
        } else {
            $hashed_password = md5($password);
            $stmt = $this->db->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }

    public function changePassword($username, $currentPassword, $newPassword, $confirmPassword)
    {
        // Verifique se as senhas novas coincidem
        if ($newPassword === $confirmPassword) {
            // Verifique se a senha atual está correta
            if ($this->verifyPassword($username, $currentPassword)) {
                // Altere a senha no banco de dados
                $hashed_password = md5($newPassword); // ou qualquer outra função de hash desejada
                $stmt = $this->db->conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $stmt->bind_param("ss", $hashed_password, $username);
                if ($stmt->execute()) {
                    return true;
                }
            }
        }
        return false;
    }

    private function verifyPassword($username, $password)
    {
        $stmt = $this->db->conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] === md5($password)) { // ou qualquer outra função de hash desejada
                return true;
            }
        }
        return false;
    }

    public function getAllUsers()
    {
        $users = array();
        $conn = $this->db->conn;
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function getUserById($userId)
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUser($userId, $username)
    {
        $stmt = $this->db->conn->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->bind_param("si", $username, $userId);
        return $stmt->execute();
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createUser($username, $password)
    {
        // Hash da senha
        $hashed_password = md5($password);

        $stmt = $this->db->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
        return $stmt->execute();
    }

    public function deleteUser($userId)
    {
        $stmt = $this->db->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }
}
