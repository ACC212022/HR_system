<!-- social Section Starts Here -->
<section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>Hotel Reservation Website</p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
<script type="text/javascript">
    document.getElementById('startdate').onchange = function () {
        var end = document.getElementById('enddate');
        end.setAttribute('min', this.value);
        if (end.value !='' && end.value < this.value){
            end.value=this.value;
        }
    };

    function GetDays(){
        var startdate = new Date(document.getElementById("startdate").value);
        var enddate = new Date(document.getElementById("enddate").value);
        return parseInt((enddate - startdate) / (24 * 3600 * 1000));
    }

    function cal(){
        if(document.getElementById("enddate")){
            document.getElementById("numdays2").value=GetDays();
        }  
    }
</script>
</html>