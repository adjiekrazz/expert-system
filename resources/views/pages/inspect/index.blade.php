@extends('layouts.guest')
@section('title', 'Cari Peribahasa')
@section('content')
</div>
    <div class="wrapper wrapper-content">
        <div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold">Mulai Cari Peribahasa?</h3>
            <div class="error-desc">
                <button class="btn btn-primary m-t" onclick="startQuestions()">Mulai</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script>
        $(document).ready(() => {

        })

        function startQuestions(){
            swal({
                title: 'Apakah mengandung huruf A?',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Tidak",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Ya",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                }
                }).then((result) => {
                if (result.isConfirmed) {
                    swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        }
    </script>
@endsection