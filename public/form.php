<input type="text" id="url" name="url" value="https://www.instagram.com/p/B0KZLHRBqZk/" />
<button id="boom">Boom</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
	$("#boom").click(function() {

        var vid_url = $("#url").val();

        for( i = 0; i <= 1000; i++){
            setTimeout(function(){
                action(vid_url);    
            }, i+"000")

            console.log(i);
        }
        
	});
	
	function action(url){
	    $.ajax({
            type:"POST",
            dataType:'json',
            url:'boom.php',
            data:{url:url},
            // success function
            success:function(data){
                console.log(data);
            }
        })
	}
});
</script>