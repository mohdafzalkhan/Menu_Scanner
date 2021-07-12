<?php include("header.php"); ?>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5" ><br>
                        <br><br>
                        <h4 style="padding-left:150px;margin:0;padding-bottom:0;">Scan QR CODE</h4>
                        <video id="preview" width="100%" height="50%"></video>
                    </div>
                    <div class="col-lg-4">
                    <h4>Enter Table Number:</h4>
                    <input type="tex" name="text" id="text">

                </div>
            </div>
                <div class="row">
                    <div class="col-lg-9" style="padding-bottom:100px;padding-left:500px;">
                 <button type="button" class="btn btn-primary btn-lg" onclick="congo();">SUBMIT</button>
                    </div>
                </div>
</div>

        <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),mirror: false});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
           });
</script>
<script>
            function congo(){
                
                       swal({
                                title: "Congratulations!",
                                text: "Your order is successfully placed",
                                icon: "success"
                            }).then(function() {
                                window.location = "success.php";
                            });
                            }
        </script>
    
       
<?php
include("footer.php");
?>