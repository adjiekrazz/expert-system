@extends('layouts.default')
@section('title', 'Home')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox animated fadeIn">
		<div class="ibox-content">
			<div class="row">
                <div class="col-md-12">
                    <input label="Masukkan Kata / Kalimat" labelPosition="top" style="width:100%;" id="sentence">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input class="easyui-textbox" data-options="editable: false" label="Arti" labelPosition="top" style="width:100%;" id="search">
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(() => {
            $('#sentence').textbox({
                delay: 500,
                inputEvents: $.extend({}, $.fn.textbox.defaults.inputEvents, {
                    keyup: function(event){
                        if (event.which == 13) {
                            var value = $('#sentence').textbox('getValue');
                            getSentence(value);
                        }
                    }
                })
            });
        });

        function getSentence(sentence){
            $.ajax({
                url: '/sentence',
                method: 'GET',
                data: {
                    sentence: sentence
                },
                success: (response) => {
                    console.log(response)
                }
            })
        }
    </script>
@endsection