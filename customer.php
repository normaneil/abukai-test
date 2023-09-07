<?php
include "config.php";

if (!isset($_GET['email'])) {
    echo "Email is required";
    exit;
}

$sql = "SELECT id, firstname, lastname, email, city, country, created_at, image_path FROM customers WHERE email='{$_GET['email']}';";
$sth = $db_conn->prepare($sql);
$sth->execute();
$item = $sth->fetch();
if (!$item) {
    echo "Record does not exist";
    exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Customer Management Page</title>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"
      integrity="sha512-jGR1T3dQerLCSm/IGEGbndPwzszJBlKQ5Br9vuB0Pw2iyxOy+7AK+lJcCC8eaXyz/9du+bkCy4HXxByhxkHf+w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
"></script>
    <link
      href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css
"
      rel="stylesheet"
    />
  </head>
  <body>
  <div class="p-5">
    <h3 class="text-center p-5 font-bold text-2xl">Customer Information</h3>
      <div class="flex justify-center" >
        <div class="flex items-top">
          <div class="mr-5">
            <img class="w-32 h-44" src="<?php echo $item['image_path']?>" alt=" image" />
          </div>
          <div>
            <div class="font-bold text-xl"><?php echo $item['firstname']?> <?php echo $item['lastname']?></div>
            <div>Email: <?php echo $item['email']?></div>
            <div>City/Country: <?php echo $item['city']?> <?php echo $item['country']?></div>
          </div>
        </div>
        
      </div>
    </div>
    <a href="/customer"><< Back</a>
  
  </body>
</html>
