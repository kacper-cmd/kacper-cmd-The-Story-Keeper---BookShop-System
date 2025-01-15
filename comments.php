<?php include('common-part-shop/menu.php'); ?>

<?php
    // Array of vulgar words
    $vulgar_words = array("damn", "crap", "stupid", "idiot","shit","asshole","fuck");
	if(isset($_POST['postComment'])){
	// loads received data into $post variable	
	$name = mysqli_real_escape_string($conn,trim($_POST['nameComment'])) ?? '';
	$post = mysqli_real_escape_string($conn,trim($_POST['postComment'])) ?? '';
    //Replaces $post to one line with <br> tags
    $post = str_replace("\n", "<br>", $post);
    $post = str_replace(";", " ", $post);
    //Removes \r (or \x0D) sequences to be correct in Windows
    $post = str_replace("\x0D", "", $post);

    // Use a loop to iterate through the vulgar words array and use str_replace to replace each instance of the vulgar word with the placeholder string
    foreach ($vulgar_words as $word) {
        $length = strlen($word)-2;
        $star = str_repeat("*", $length);
        $lowerStr = strtolower($post);
        $post = str_replace($word, substr($word, 0, 1).$star.substr($word, -1), $lowerStr);
    }
	// opens the file to append and writes the post content	
	if(!empty(trim($post)) && $name !='') { // writes only if post is nonempty
		$file=@fopen('comments.txt','a') or exit("No comments file");
        if (flock($file,LOCK_EX)) {
            fputs($file,$name.";");
            fputs($file,$post.PHP_EOL);
            fflush($file);
            // release lock
            flock($file,LOCK_UN);
		}else {
            echo "Error locking file!";
          }
		fclose($file);
        header("Location: comments.php");			
	}
}
?>

<div class="container">
<br><br><h3 class="text-center" style="color: #0a3d62">Let me know what do you think about my website ? </h3><br>
<h4 class="text-center" style="color: #0a3d62">I will gladly accept any suggestions and proposals.</h4><br><br>
<div class="container" >
<form method='POST'>
    <p>
        <!-- <label for="name"></label><br> -->
        <h4>Enter a name:</h4><br>
        <input type="text" name="nameComment" size=40 required><br><br>
    </p>
    <p>
    <!-- <label for="comment">Comment:</label><br> -->
    <h4>Comment: (Max. 80 chars limit)</h4><br>
    <!-- js oninput below with source -->
    <textarea name="postComment" id="comment" rows="4" cols="40" maxlength="80" oninput="limitChar()" required></textarea><br>
    <p  id="charCounter">80 Characters limit</p><br>  
</p>
  <p>
    <input type="submit" name="submit" class="btn btn-primary" value="Send"><br><br><br>
  </p>
</form>
</div>

<?php
	// HERE WRITE A CODE, WHICH READS POSTS FROM THE FILE comments.txt
	// AND DISPLAYS THEM ON THE PAGE
 
	if(!file_exists('comments.txt') || empty(file("comments.txt"))){//if file doesn't exist or is empty
		echo "There is no file with comments data";
        $file = fopen("comments.txt", "w");//create file
    }else {
        $file = fopen("comments.txt","r+");//https://www.php.net/manual/en/function.fopen.php
        $userData = fgetcsv($file,0,';');//https://www.php.net/manual/en/function.fgetcsv.php
		$lines = file('comments.txt');//https://www.php.net/manual/en/function.file.php
        ?>
        <h4 class="text-center">See comments below:</h4><br><br>
        <table class="tbl-full book-menu-desc" style="border:2px solid black; border-spacing: 15px;">
        <tr>
        <th><h3>Name</h3></th>
            <th><h3>Comment</h3></th>
        </tr>
        <?php
		foreach($lines as $line){
            $userData = explode(';',$line);//https://www.php.net/manual/en/function.explode.php
            echo "<tr><td><h4>$userData[0]</h4></td>";
            echo "<td><h4>$userData[1]</h4></td>".'</tr>';
        }
        fclose($file);
	}
?>
    </table>
 <div class="clearfix"></div>

 <!-- based on https://www.encodedna.com/javascript/limit-character-input-in-textarea-using-javascript.html -->
 <script>
    let limitChar = () => {
        const maxChar = 80;
        let ele = document.getElementById("comment");// <textarea> element 
        let charLen = ele.value.length;// length of the text in the textarea element
        let p = document.getElementById('charCounter');// <p> element to display the remaining characters
        p.innerHTML = maxChar - charLen + ' characters remaining';// display the remaining characters in the <p> element 
        if (charLen > maxChar)  
        {
            ele.value = ele.value.substring(0, maxChar);// https://www.w3schools.com/jsref/jsref_substring.asp
            p.innerHTML = 0 + ' characters remaining'; 
        }
    }
</script>

<?php include('common-part-shop/footer.php'); ?>
