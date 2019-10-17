<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP TWLP Fundamental</title>
<style>
	.phpcoding{ width: 900px; margin:0 auto; background:#ddd; padding:15px; }
	.headersection , .footersection{ background:#444; color:#fff; text-align:center; padding-top:15px; padding-bottom:15px; }
	.mainsection { min-height:450px; padding:20px;}
</style>
</head>

<body>
    <div class="phpcoding">
        <section class="headersection">
            <h2>PHP TWLP Fundamental </h2>
        </section>
        
        <section class="mainsection">
          


            <?php 

            $creatFile = fopen('data.txt','w');

            $one = "My name is topma \n";
            fwrite($creatFile, $one);

             $two = " I am 24 years old \n";
            fwrite($creatFile, $two);

            fclose($creatFile);


            $openFile = fopen("data.txt",'r');

            while (!feof($openFile)) {
                echo fgets($openFile,filesize('data.txt'))."<br>";
            }

            fclose($openFile);


            ?>











        </section>
        
        <section class="footersection">
            <h2>Practice By Md. Nuruzzaman himel </h2>
        </section>
    </div>

</body>
</html>