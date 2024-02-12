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

print_r($_POST);
var_dump($password_hash);