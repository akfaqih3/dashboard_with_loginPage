<?php session_start(); ?>
<?php if(!isset($_SESSION['status'])) header("location:index.php");?>
<?php require("process.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_sryle.css">
    <title>admin</title>
</head>
<body dir="rtl">

    <?php if (!isset($_REQUEST['id'])):?>
    <div class="form">

        <form action="process.php" method="post" enctype="multipart/form-data">

            <label for="product-image" class="lbl_img">أنقر لإضافة صورة</label>
            <input type="file" id="product-image" name="product-image" accept="image/*" style="display: none;" required>

            <label for="product-name">الاسم</label>
            <input type="text" id="product-name" name="product-name" required>

            <label for="product-description">الوصف</label>
            <textarea id="product-description" name="product-description" rows="3" required></textarea>

            <button type="submit" name="save">إضافة </button>
        </form>
        <hr>
    </div>
    <?php else :?>

        <?php 
            $id=$_REQUEST['id'];
            $sql_select = "SELECT * FROM products WHERE id=$id";
            $result = mysqli_query($conn,$sql_select);
            if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            }
        ?>
        <div class="form">

        <form action="process.php" method="post" enctype="multipart/form-data">
        <input type="text" id="id" name="id" value="<?php echo $row['id']?>" style="display: none;" >
        <label for="product-image" class="lbl_img"><img src="<?php echo $row['image']?>" alt=""></label>
        <input type="file" id="product-image" name="product-image" accept="image/*" style="display: none;">

        <label for="product-name">الاسم</label>
        <input type="text" id="product-name" name="product-name" value="<?php echo $row['name']?>" required>

        <label for="product-description">الوصف</label>
        <textarea id="product-description" name="product-description" rows="3" required><?php echo $row['text']?></textarea>

        <button type="submit" name="save_edit">حفظ التعديل</button>
        </form>
        <hr>
        </div>
    <?php endif?>

    <section class="products">
        <?php 
            
            // استرداد البيانات من جدول قاعدة البيانات
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn,$sql);

            // عرض البيانات على صفحة المنتجات
            if (mysqli_num_rows($result)>0):?>
                <?php while($row=mysqli_fetch_assoc($result)): ?>

                    <div class="form">

                        <form action="process.php" method="post" enctype="multipart/form-data">

                            <input type="text" id="id" name="id" value="<?php echo $row['id']?>" style="display: none;" >

                            <label for="" class="lbl_img"><img src="<?php echo $row['image']?>" alt=""></label>
                            
                            
                            <input type="text" id="product-name" name="product-name" value="<?php echo $row['name']?>" readonly>

                            
                            <textarea id="product-description" name="product-description" rows="3" readonly ><?php echo $row['text']?></textarea>

                            <div class="btns">
                                <button type="submit" name="update" style="background-color: darkblue;">تعديل </button>
                                <button type="submit" name="delete" style="background-color: darkred;">حذف </button>
                            </div>
                        </form>

                    </div>
                <?php endwhile;?>
                <?php else :echo "لا يوجد منتجات متاحة حاليًا";?>
            <?php endif;?>
        <?php // إغلاق اتصال قاعدة البيانات
            //mysqli_close($conn);
            ?>

    </section>

</body>
</html>
