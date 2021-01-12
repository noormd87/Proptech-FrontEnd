<?php include"header.php"; ?>


<?php

    
    $user_id   = \settings\session\sessionClass::GetSessionDisplayName();
    
     $url = "https://duvalknowledge.com/PropTech/Portfolio/ProfolioComparisonPdf.html?PropertyCnt=6,7,8&ViewCompare=R&IsPdf=Y"; 


    
?>
   

            <div class="row">
                <div class="col-12">
                    <div class="card client-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                        <br><br>
                                    <form class="form-inline" name="tempform" method="post" action="<?php echo SITE_BASE_URL; ?>Portfolio/ProfolioComparisonPdf.html?PropertyCnt=6,7,8&ViewCompare=R&IsPdf=Y">
                                 
                                        <?php
                                        
                                        try
                                        {
                                            // create the API client instance
                                            $client = new \Pdfcrowd\HtmlToPdfClient("demo", "ce544b6ea52a5621fb9d55f8b542d14d");
                                            
                                           
                                            
                                            //echo $url; exit; 
                                        
                                            // run the conversion and write the result to a file
                                            $client->convertUrlToFile($url, "InvestCompare.pdf");
                                            
                                            echo "<a href='" . SITE_BASE_URL . "InvestCompare.pdf' target='_blank'>Download PDF</a>"; 
                                        }
                                        catch(\Pdfcrowd\Error $why)
                                        {
                                            // report the error
                                            error_log("Pdfcrowd Error: {$why}\n");
                                        
                                            // rethrow or handle the exception
                                            throw $why;
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .container fluide -->



<?php include"footer.php"; ?>


<script>
    
    $(document).on("change", "[rel='Links']", function(){
        id = $(this).attr("client_id");
        menu_name = this.value;
        link_type = $(this).find('option:selected').attr("link_type");
        query_str = $(this).find('option:selected').attr("query_str");
        
        if (query_str == undefined){
            query_str = "";
        }
        
        if (query_str != ""){
            query_str = "&" + query_str;
        }
        
        //console.log("<?php echo SITE_BASE_URL; ?>" + link_type + ".html?d=<?php echo time(); ?>&id=" + id + query_str);
        //return false; 
        
        window.location.href = "<?php echo SITE_BASE_URL; ?>" + link_type + ".html?d=<?php echo time(); ?>&id=" + id + query_str; 
    });
    
    $(document).on("click", ".addnewBtn", function(){
        ErrCount = 0;

        $(".mandate:visible").each(function(){
                if (this.value == ""){
                    alert("Please select field : " + this.name);
                    $(this).focus();
                    ErrCount++;
                    return false;
                }
        });

        if (ErrCount != 0){
                return false;
        }


        noOfClient	= $("[name='noOfClient']").val(); 

        if (isNaN(parseInt(noOfClient)))
                noOfClient = 0;

        if (parseInt(noOfClient) == 0){
                alert("Please type total client");
                return false; 
        }

        document.form1.submit();
});




</script>

</body>
</html>


    
