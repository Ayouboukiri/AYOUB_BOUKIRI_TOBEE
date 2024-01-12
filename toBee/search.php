<?php
	if(isset($_POST['search']))  
	{
       
		if(!empty($_POST['search']))  
		{
            $sql1 = "SELECT * FROM product WHERE title='" . $_POST['search'] . "'";
			
			$result = $conn->query($sql1);
			if (mysqli_num_rows($result) === 1){
                
                
                while($enreg = mysqli_fetch_assoc($result))
				{ 
                    
                    echo( '<div class="popup_container">
                    
                    <img src='.$enreg['image'].' alt="" class="popup_img">
                    <h2 class="popup_title">'.$enreg['title'].'</h2>
                    <h4 class="popup_price">'.$enreg['price'].' DH</h4>
                    <i class="bx bx-x popup_remove" onclick="close_popup()"></i>
                    ');
                    echo('</div>');
                    
                   
				} 
                
            }else echo( "<div class='popup_container'><img src='image\Votre texte de paragraphe.png' alt='' class='err_message'>
            <i class='bx bx-x popup_remove' onclick='close_popup()'></i>
            ");
            echo('</div>');
				
			}}
?>