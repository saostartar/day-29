<div id="output"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.css">

<script>
    var products = @json($products);

    $(function(){
        $("#output").pivotUI(products, {
            rows: ["name"],
            cols: ["price"],
            aggregatorName: "Sum",
            vals: ["stock"]
        });
    });
</script>
