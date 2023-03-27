<div id="content_admin_tax_manager">
    <div class="content_admin_button_view">
        <button type='button' class="content_admin_table_item_button"><i class="fa-solid fa-plus fa-2xl"></i></button>
    </div>
    <div class="content_admin_table_view">
        <table id="content_admin_tax_table" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th>Tax ID</th>
                    <th>Tax Des</th>
                    <th>Tax Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "./template/dbconnection_GET.php",
            type: "POST",
            data: { table_name: "taxinfo" },
            dataType: "json",
            success: function(result) {
                console.log('result: ', result);
                $.each(result, function(i, item) {
                    $("#content_admin_tax_table tbody")
                        .append(
                            "<tr>"+
                                "<td>" + item.TaxId + "</td>" + 
                                "<td>" + item.TaxDes + "</td>" + 
                                "<td>" + item.TaxRate + "</td>" + 
                                "<td>" + 
                                    "<button type='button' class='content_admin_table_item_button'>Edit</i></button>" + 
                                "</td>" + 
                            "</tr>"
                        );
                });
            }
        });
    });
</script>