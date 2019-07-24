<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                /*vertical-align: middle;*/
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
                margin-bottom: 40px;
            }

            .quote {
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">SMS Administration</div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('messages') }}" id="messages_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">* Number</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="number">
                        </div>
                        <label class="col-md-2 control-label">* Message</label>
                        <div class="col-md-4">
                            <textarea class="form-control" name="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-12 text-center top-buffer">
                        <div class="col-md-6 col-md-offset-5">
                            <button type="submit" class="btn btn-primary col-md-5">
                            Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
