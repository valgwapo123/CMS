  <center style="margin-top: 60px;">
          <a href="/"><img src="<?php echo base_url(); ?>application/public/assets/images/logoIcon/logo.png" alt="site-logo"  ></a>
       </center>
  <video id="video" muted autoplay playsinline ></video>
  
  <canvas id="canvas" hidden></canvas>
  
  <script>
    var video = document.getElementById("video");
    var tickDuration = 200;
    video.style.boxSizing = "border-box";
    
    video.style.height = 400+'px';
    video.style.width = '100%';
    video.style.zIndex = 5;

    function drawLine(begin, end, color) {
      canvas.beginPath();
      canvas.moveTo(begin.x, begin.y);
      canvas.lineTo(end.x, end.y);
      canvas.lineWidth = 4;
      canvas.strokeStyle = color;
      canvas.stroke();
    }

    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) 
    {
        video.srcObject = stream;
        video.play();
        setTimeout(function() {tick();},tickDuration);
    });






    function tick() 
    {
        try
        {
            var canvasElement = document.createElement("canvas");            
            var canvas = canvasElement.getContext("2d");
            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
            var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            var code = jsQR(imageData.data, imageData.width, imageData.height, { inversionAttempts: "dontInvert" });
            if (code) 
            {                
               location.href="/qrcode/"+code.data;
               video.pause();
               tickDuration=10000;
            } 
        }
        catch (t) 
        {
            console.log("PROBLEM: " + t);
        }
        setTimeout(function() {tick();},tickDuration);
    }



      var pathLink="<?php echo base_url(); ?>";
      // has permission grant
          navigator.permissions.query({ name: "camera" }).then(res => {
            if(res.state == "granted"){
            // has permission
                console.log('open');

            
            }else{
               window.location.href = pathLink +'/quick-register';
                console.log('close');
            }
          });


    
  </script>



  
</body>
</html>