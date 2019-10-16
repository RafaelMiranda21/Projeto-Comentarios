<meta charset="UTF-8"/>

<?php
 try{
  $pdo = new PDO("mysql:dbname=blog;host=localhost","root","");
 }catch(PDOException $e){
  echo"ERRO: ".$e->getMessage();
 }

if(isset($_POST['nome']) && !empty($_POST['nome'])){
  $nome = addslashes($_POST['nome']);
  $msg = addslashes($_POST['mensagem']);

  $sql = $pdo->prepare("INSERT INTO mensagens SET nome=:nome,msg=:msg,data_msg=NOW()");
  $sql->bindValue(":nome",$nome);
  $sql->bindValue(":msg",$msg);
  $sql->execute();
}



?>

<fieldset>
  <form method="POST">
  Nome:</br>
  <input type="text" name="nome"/></br></br>
  Messagem:</br>
  <textarea name="mensagem"></textarea></br></br>
   <input type="submit" value="Enviar mensagem"/>
   </form>
</fieldset>

<?php
  $sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
  $sql = $pdo->query($sql);

  if($sql->rowCount() > 0){
    foreach($sql->fetchAll() as $mensagem):
  ?>
     <strong><?php echo $mensagem['nome']."    ".$mensagem['data_msg'];?></strong></br>
     <?php echo $mensagem['msg']; ?>
     <hr/></br>

<?php
    endforeach;  
  }else{
    echo"Não há mensagem";
  }

?>
