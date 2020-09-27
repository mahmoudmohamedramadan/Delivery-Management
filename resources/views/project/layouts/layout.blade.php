<script>
    $(document).ready(function() {
        $('#delegate-order-{{ $delegate->id }}').click(function() {
            $.ajax({
                url: '/index/ajax/delegate-order/{{ $delegate->id }}',
                type: 'get',
                dataType: 'json',
                data: {},
                success: function(data) {
                    if (data.status) {
                        console.log(data.orders);
                        $('.modal-body').empty().html(data.orders);
                        $('#delegate-order').modal('show');
                    }
                },
                error: function(data) {
                    console.log(data);
                },
            });
        });
    });

</script>

<td>
    <form action="/index/delegate/{{ $delegate->id }}" method="POST"
        style="width:auto;margin:0px;padding:0px; background:none">
        @csrf
        @method('DELETE')
        @if ($delegate->orders->count() > 0)
            <button type="button" class="btn btn-success" data-toggle="modal" id="delegate-order-{{ $delegate->id }}">
                Orders
            </button>
        @endif
        <input type="submit" value="Delete" class="btn btn-danger">
        <input type="button" value="Delete Ajax" class="delete-ajax btn btn-danger" delete-id="{{ $delegate->id }}">
    </form>
</td>
<!-- Modal -->
<div class="modal fade" id="delegate-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $delegate->name }} Orders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
