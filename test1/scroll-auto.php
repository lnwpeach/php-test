<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $("#click").click(function (){
                var a = $("#div2").offset().top;
                var b = $("#div2").height() / 2;
                console.log(a);
                console.log(b);
                $('html, body').animate({
                    scrollTop: a-b
                },300);
            });
        });
    </script>
    <div id="div1" style="height: 1000px; width 100px">
        Test
    </div>
    <br/>
    <div id="div2" style="height: 1000px; width 100px">
        Test 2
    </div>
    <button id="click">Click me</button>
</html>