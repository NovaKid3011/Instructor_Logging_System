@isset($search)
    @if ($attendances->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var noResultsModal = new bootstrap.Modal(document.getElementById('noResultsModal'));
                noResultsModal.show();
            });
        </script>
    @endif
@endisset

<div class="modal fade" id="noResultsModal" tabindex="-1" aria-labelledby="noResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="noResultsModalLabel">No Results Found</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                No results were found for the query "{{ $search }}".
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-primary py-2 m-0" data-bs-dismiss="modal"
                style="border-radius:2px; font-size:small ;">Okay</button>
            </div>
        </div>
    </div>
</div>
