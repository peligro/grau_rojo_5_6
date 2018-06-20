
<table id="table-transform" data-toolbar="#transform-buttons">
    <thead>
    <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Item Price</th>
    </tr>
    </thead>
    <tbody>
    <tr id="tr_id_1" class="tr-class-1">
        <td id="td_id_1" class="td-class-1">1</td>
        <td>Item 1</td>
        <td>$1</td>
    </tr>
    <tr id="tr_id_2" class="tr-class-2">
        <td id="td_id_2" class="td-class-2">2</td>
        <td>Item 2</td>
        <td>$2</td>
    </tr>
    <tr id="tr_id_3" class="tr-class-3">
        <td id="td_id_3" class="td-class-3">3</td>
        <td>Item 3</td>
        <td>$3</td>
    </tr>
    <tr id="tr_id_4" class="tr-class-4">
        <td id="td_id_4" class="td-class-4">4</td>
        <td>Item 4</td>
        <td>$4</td>
    </tr>
    <tr id="tr_id_5" class="tr-class-5">
        <td id="td_id_5" class="td-class-5">5</td>
        <td>Item 5</td>
        <td>$5</td>
    </tr>
    </tbody>
</table>
<script>
    $(function () {
        var $table = $('#table-transform');
            $table.bootstrapTable();
    });
</script>