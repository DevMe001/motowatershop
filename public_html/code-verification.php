<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }
    
    
function decrypt($encryptedValue, $key) {
    return openssl_decrypt(base64_decode($encryptedValue), 'aes-256-cbc', $key, 0, substr($key, 0, 16));
}

$encryptedCode = $_GET['code'];
$key = 'EMAILVERIFICATION2024';    

$decryptedCode = decrypt(urldecode($encryptedCode), $key);

$spliceDecrptedCode = str_split($decryptedCode);




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
    <style>
:root {
  --spacing: 8px;
  --hue: 400;
  --background1: #ffffff;
  --background2: hsl(214, 14%, 13%);
  --background3: hsl(214, 14%, 5%);
  --brand1: #7e7e7e;
  --text1:  #000;
  --text2: hsl(0, 0%, 90%);
}
        
.number-code {
  overflow: auto;
  > div {
    display: flex;
    > input:not(:last-child) {
      margin-right: calc(var(--spacing) * 2);
    }
  }
}

.code-input{
    font-size:2.5rem;
    text-align:center;
}

.verifyLabel{
   padding-bottom:1rem;
   font-size:1.5rem;
}

form {
  
  input.code-input {
    font-size: 1.5rem;
    width: 1rem;
    text-align: center;
    flex: 1 0 1rem;
    border:1px solid #7e7e7e;
  }

  input {
    
    padding: var(--spacing);
    border-radius: calc(var(--spacing) / 2);
    color: var(--text1);
    background: var(--background1);
    border: 0;
    border: 4px solid transparent;
    &:invalid {
      box-shadow: none;
    }
    &:focus {
      outline: none;
      border: 4px solid var(--brand1);
      background: var(--background1);
    }
  }
}
    </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
  
<section  class="form-container">
   
   <form id='verifyForm'>
       

       
      <h3>Verify your account</h3>
       <div id='showMsg' class='alert alert-info'></div>"
        <fieldset class='number-code'>
        <legend class='verifyLabel'>Security Code</legend>
        <div>
        <input name='code[]' class='code-input' value="<?php echo $spliceDecrptedCode[0] ?? ''; ?>" required/>
        <input name='code[]' class='code-input' value="<?php echo $spliceDecrptedCode[1] ?? ''; ?>"  required/>
        <input name='code[]' class='code-input' value="<?php echo $spliceDecrptedCode[2] ?? ''; ?>" required/>
        <input name='code[]' class='code-input' value="<?php echo $spliceDecrptedCode[3] ?? ''; ?>" required/>
        <input name='code[]' class='code-input' value="<?php echo $spliceDecrptedCode[4] ?? ''; ?>" required/>
        <input name='code[]' class='code-input' value="<?php echo $spliceDecrptedCode[5] ?? ''; ?>" required/>
        
      
        </div>
        
    </fieldset>
     <input type="submit" class="btn"  value="Submit">
   </form>

</section>
    <!-- //form section start -->



</body>

</html>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        const inputElements = [...document.querySelectorAll('input.code-input')]
    
    inputElements.forEach((ele,index)=>{
      ele.addEventListener('keydown',(e)=>{
       
        if(e.keyCode === 8 && e.target.value==='') inputElements[Math.max(0,index-1)].focus()
      })
      ele.addEventListener('input',(e)=>{
     
        const [first,...rest] = e.target.value
        e.target.value = first ?? '' 
        const lastInputBox = index===inputElements.length-1
        const didInsertContent = first!==undefined
        if(didInsertContent && !lastInputBox) {
          // continue to input the rest of the string
          inputElements[index+1].focus()
          inputElements[index+1].value = rest.join('')
          inputElements[index+1].dispatchEvent(new Event('input'))
        }
      })
    })
    
    </script>
    


    <script>
        $(document).ready(function(){
           $('#verifyForm').submit(function(e){
               e.preventDefault();
               const formInput = document.getElementById('verifyForm');
               const formData = new FormData(formInput);
               
               
               $.ajax({
                   url:'email-verification.php',
                   type:'POST',
                   data:formData,
                  processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    dataType: "json",
                   success:function(res){
                       if(res.success){
                         Swal.fire({
                        icon: 'success',
                        title: 'Accepted request',
                        text: res.message
                        });
                        
                        setTimeout(function(){
                            location.href = 'login.php';
                        },2000)
                       }else{
                           Swal.fire({
                        icon: 'error',
                         title: 'Forbidden request',
                        text: res.message
                        });
                       }
                   },
                   error:function(err){
                        Swal.fire({
                        icon: 'error',
                        title: JSON.stringify(err),
                        text: 'Something went wrong!'
                        });
                   }
                   
               });
           });
        });
    </script>