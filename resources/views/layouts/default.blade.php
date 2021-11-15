<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LBG | @yield('title')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery-easyui-1.10.0/themes/material/easyui.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery-easyui-1.10.0/themes/color.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery-easyui-1.10.0/themes/icon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/preloader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ict.css') }}" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        @include('components.sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('components.navbar')
            @include('components.breadcrumb')
            <div class="preloader flex-column justify-content-center align-items-center">
                <div class="sk-spinner sk-spinner-three-bounce">
                    <div class="sk-bounce1"></div>
                    <div class="sk-bounce2"></div>
                    <div class="sk-bounce3"></div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('jquery-easyui-1.10.0/jquery.easyui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/datagrid-export.js') }}"></script>
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script>
        function toMysqlDatetimeFormatter(datetime, time = true){
			var year = datetime.getFullYear();
			var month = datetime.getMonth() + 1;
			var day = datetime.getDate();
			if (time){
                var hour = datetime.getHours();
                var minute = datetime.getMinutes();
                var second = datetime.getSeconds();
			
                return year + '-' + (month<10?('0'+month):month) + '-' + (day<10?('0'+day):day) + ' ' + (hour<10?('0'+hour):hour) + ':' + (minute<10?('0'+minute):minute) + ':' + (second<10?('0'+second):second);
            }
            return year + '-' + (month<10?('0'+month):month) + '-' + (day<10?('0'+day):day);
        }
		
		function fromMysqlDateTimeParser(datetime, time = true){
			if (!datetime) return new Date();
			var splittedDate = (datetime.split(' ')[0]).split('-');
			var year = parseInt(splittedDate[0], 10);
			var month = parseInt(splittedDate[1], 10);
			var day = parseInt(splittedDate[2], 10);
            if (time){
                var splittedTime = (datetime.split(' ')[1]).split(':');
                var hour = parseInt(splittedTime[0], 10);
                var minute = parseInt(splittedTime[1], 10);
                var second = parseInt(splittedTime[2], 10);
            }
            
			if (!(isNaN(year) && isNaN(month) && isNaN(day) && isNaN(hour) && isNaN(minute) && isNaN(second))) {
				if (time) return new Date(year, month - 1, day, hour, minute, second);
                return new Date(year, month - 1, day);
			} else {
				return new Date();
			}
		}

		function rowCurrencyFormatter(value){
			if (value == undefined) return 0;
			return Intl.NumberFormat('id-ID').format(value);
		}

		function rowIsRepeatOrderFormatter(value){
			return (value == 0) ? 'New' : 'Repeat';
		}

		function rowIsFinishGoodFormatter(value){
			return (value == 0) ? 'No' : 'Yes';
		}

		function rowDateFormatter(value){
			return (new Date(value)).toLocaleString();
		}
    </script>
    @yield('javascript')
</body>
</html>