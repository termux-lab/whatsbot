<?php
if(!is_dir(__DIR__."/../../cat_db/")){
	if(isset($_GET["login"]) and isset($_GET["password"])){
		mkdir(__DIR__."/../../cat_db");
		mkdir(__DIR__."/../../cat_db/".md5($_GET["login"]).md5($_GET["password"]));
		echo("ok");
	}else{
		?>
		<form>
			<input type="text" name="login" placeholder="new login">
			<input type="password" name="password" placeholder="new password">
			<input type="submit" value="install">
		</form>
		<?php
	}
}
?>
