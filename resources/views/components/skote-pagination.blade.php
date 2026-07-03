@if($paginator->hasPages())

<div class="row align-items-center mt-3">

    <div class="col-sm-12 col-md-5">

        <div class="dataTables_info"
             role="status"
             aria-live="polite">

            Showing
            <strong>{{ $paginator->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $paginator->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $paginator->total() }}</strong>
            entries

        </div>

    </div>

    <div class="col-sm-12 col-md-7">

        <div class="d-flex justify-content-md-end justify-content-center">

            {{ $paginator->onEachSide(1)->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endif