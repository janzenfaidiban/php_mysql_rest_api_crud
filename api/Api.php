<?php 

class API
{
    private $connect = '';

    function __construct()
    {
        $this->database_connection();
    }

    function database_connection() 
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");
    }

    function fetch_all()
    {
        $query = "SELECT * FROM tbl_sample ORDER BY id";
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    function insert()
    {
        if(isset($_POST['first_name']))
        {
            $form_data = array(
                ':first_name'   => $_POST['first_name'],
                ':last_name'   => $_POST['last_name'],
                ':email'   => $_POST['email'],
            );
            $query = "
                INSERT INTO tbl_sample (first_name, last_name, email) VALUES (:first_name, :last_name, :email)
            ";
            $statement = $this->connect->prepare($query);
            if($statement->execute($form_data))
            {
                $data[] = array (
                    'success' => '1'
                );
            }
            else 
            {
                $data[] = array(
                    'success' => '0'
                );
            }
        } 
        else 
        {
            $data[] = array (
                'success' => '0'
            );
        }
        return $data;
    }


    function fetch_single($id)
    {
        $query = 'SELECT * FROM tbl_sample WHERE id='.$id.'';
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            foreach($statement->fetchAll() as $row)
            {
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['email'] = $row['email'];
            }
            return $data;
        }
    }

    function update()
    {
        if(isset($_POST['first_name']))
        {
            $form_data = array (
                ':first_name' => $_POST['first_name'],
                ':last_name' => $_POST['last_name'],
                ':email' => $_POST['email'],
                ':id' => $_POST['id']
            );
            $query = '
                UPDATE tbl_sample
                SET first_name = :first_name, last_name = :last_name, email = :email
                WHERE id = :id
            ';
            $statement = $this->connect->prepare($query);
            if($statement->execute($form_data))
            {
                $data[] = array(
                    'success' => '1'
                );
            }
            return $data;
        }
    }


    function delete($id)
    {
    $query = "DELETE FROM tbl_sample WHERE id = '".$id."'";
    $statement = $this->connect->prepare($query);
    if($statement->execute())
        {
        $data[] = array(
            'success' => '1'
            );
        }
        else
        {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }

}

?>