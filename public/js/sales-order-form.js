$(document).ready(function () {
    var products = window.salesOrderProducts || [];
    var oldProducts = window.oldProducts || [];
    var rowCount = 0;

    function getSelectedProductIds() {
        var ids = [];
        $('.product-select').each(function () {
            var val = $(this).val();
            if (val) ids.push(val);
        });
        return ids;
    }

    function refreshDropdowns() {
        var selectedIds = getSelectedProductIds();

        $('.product-select').each(function () {
            var $select = $(this);
            var currentVal = $select.val();

            $select.find('option').each(function () {
                var val = $(this).val();
                if (val && val !== currentVal && selectedIds.includes(val)) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });

            $select.select2('destroy').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });
    }

    function addRow(productId = '', quantity = 1) {
        rowCount++;

        var options = '<option value="">-- Select --</option>';
        products.forEach(function (p) {
            var selected = (p.id == productId) ? 'selected' : '';
            options += `<option value="${p.id}" data-price="${p.price}" ${selected}>${p.name}</option>`;
        });

        var product = products.find(p => p.id == productId);
        var price = product ? product.price : 0;
        var total = (price * quantity).toFixed(2);

        var row = `
            <tr id="row-${rowCount}">
                <td>
                    <select name="products[${rowCount}][product_id]" class="form-select product-select" data-row="${rowCount}" required>
                        ${options}
                    </select>
                </td>
                <td><input type="number" step="0.01" class="form-control price" name="products[${rowCount}][price]" value="${price}" readonly></td>
                <td><input type="number" min="1" class="form-control qty" name="products[${rowCount}][quantity]" value="${quantity}"></td>
                <td><input type="number" class="form-control line-total" name="products[${rowCount}][total]" value="${total}" readonly></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="bi bi-trash"></i></button></td>
            </tr>
        `;

        $('#itemBody').append(row);
        initSelect2();
        refreshDropdowns();
        updateTotal();
    }

    function initSelect2() {
        $('.product-select').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        $('.product-select').off('change').on('change', function () {
            var rowId = $(this).data('row');
            var price = $(this).find(':selected').data('price') || 0;

            $('#row-' + rowId + ' .price').val(price);
            calculateLineTotal(rowId);
            refreshDropdowns();
        });
    }

    function calculateLineTotal(rowId) {
        var qty = parseFloat($('#row-' + rowId + ' .qty').val()) || 0;
        var price = parseFloat($('#row-' + rowId + ' .price').val()) || 0;
        var total = (qty * price).toFixed(2);
        $('#row-' + rowId + ' .line-total').val(total);
        updateTotal();
    }

    function updateTotal() {
        var grandTotal = 0;
        $('.line-total').each(function () {
            grandTotal += parseFloat($(this).val()) || 0;
        });
        $('#grandTotal').text(grandTotal.toFixed(2));
    }

    $(document).on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        updateTotal();
        refreshDropdowns();
    });

    $(document).on('input', '.qty', function () {
        var rowId = $(this).closest('tr').attr('id').split('-')[1];
        calculateLineTotal(rowId);
    });

    // Load old input if available
    if (oldProducts.length > 0) {
        for (var i = 0; i < oldProducts.length; i++) {
            var item = oldProducts[i];
            addRow(item.product_id, item.quantity);
        }
    } else {
        addRow();
    }

    window.addRow = addRow;
});
