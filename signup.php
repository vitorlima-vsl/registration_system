<?php
if(empty($_POST["name"]))
{
    die("o campo nome é obrigatório");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("email inválido"); //usando die só para teste, depois vou trocar (talvez usar javascript)
}

if(strlen($_POST["password"]) < 6)
{
    die("a senha tem que ter pelomenos 6 caracteres");
}

if(!preg_match("/[a-z]/i", $_POST["password"]))
{
    die("a senha tem que ter pelomenos uma letra");
}
if(!preg_match("/[0-9]/", $_POST["password"]))
{
    die("a senha tem que ter pelomenos um número");
}
if($_POST["password"] !== $_POST["confirm_password"])
{
    die("as senhas devem ser iguais");
}
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ ."/database.php";


//se deixar o campo de id livre, ele é auto preenchido, sendo assim um valor será dado
$sql = "INSERT INTO user (name, email, password_hash)  VALUES (?, ?, ?)";


//statement
$stmt = $mysqli->stmt_init();


try
{    
//se houver algum erro no banco de dados sql, prepare vai retornar false xd
    if(!$stmt->prepare($sql)) //??
    {                         
        throw new Exception("SQL error: " . $mysqli->error);
    }
} 
catch(mysqli_sql_exception $e)
{
    // Aqui você pode lidar com a exceção de mysqli_sql_exception
    echo "Erro ao preparar a declaração SQL: " . $e->getMessage();
}
catch(Exception $e)
{
    // Lidar com outras exceções
    echo "Erro: " . $e->getMessage();
}


$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

if($stmt->execute()){
    echo"conta criada com sucesso";
}
else{
    die($mysqli->error . " " . $mysqli->errno);
}

//gotta love life :D
