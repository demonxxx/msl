@extends('admin_template')

@section('content')
    <div class='row'>
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Randomly Generated Tasks</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @foreach($tasks as $task)
                        <h5>
                            {{ $task['name'] }}
                            <small class="label label-{{$task['color']}} pull-right">{{$task['progress']}}%</small>
                        </h5>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-{{$task['color']}}" style="width: {{$task['progress']}}%"></div>
                        </div>
                    @endforeach

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <form action='#'>
                        <input type='text' placeholder='New task' class='form-control input-sm' />
                    </form>
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-md-6'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Second Box</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    A separate section to add any kind of widget. Feel free
                    to explore all of AdminLTE widgets by visiting the demo page
                    on <a href="https://almsaeedstudio.com">Almsaeed Studio</a>.
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-6">

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Social Buttons (By <a href="https://github.com/lipis/bootstrap-social">Lipis</a>)
              </h3>
            </div>
            <div class="box-body">
              <a class="btn btn-block btn-social btn-bitbucket">
                <i class="fa fa-bitbucket"></i> Sign in with Bitbucket
              </a>
              <a class="btn btn-block btn-social btn-dropbox">
                <i class="fa fa-dropbox"></i> Sign in with Dropbox
              </a>
              <a class="btn btn-block btn-social btn-facebook">
                <i class="fa fa-facebook"></i> Sign in with Facebook
              </a>
              <a class="btn btn-block btn-social btn-flickr">
                <i class="fa fa-flickr"></i> Sign in with Flickr
              </a>
              <a class="btn btn-block btn-social btn-foursquare">
                <i class="fa fa-foursquare"></i> Sign in with Foursquare
              </a>
              <a class="btn btn-block btn-social btn-github">
                <i class="fa fa-github"></i> Sign in with GitHub
              </a>
              <a class="btn btn-block btn-social btn-google">
                <i class="fa fa-google-plus"></i> Sign in with Google
              </a>
              <a class="btn btn-block btn-social btn-instagram">
                <i class="fa fa-instagram"></i> Sign in with Instagram
              </a>
              <a class="btn btn-block btn-social btn-linkedin">
                <i class="fa fa-linkedin"></i> Sign in with LinkedIn
              </a>
              <a class="btn btn-block btn-social btn-tumblr">
                <i class="fa fa-tumblr"></i> Sign in with Tumblr
              </a>
              <a class="btn btn-block btn-social btn-twitter">
                <i class="fa fa-twitter"></i> Sign in with Twitter
              </a>
              <a class="btn btn-block btn-social btn-vk">
                <i class="fa fa-vk"></i> Sign in with VK
              </a>
              <br>

              <div class="text-center">
                <a class="btn btn-social-icon btn-bitbucket"><i class="fa fa-bitbucket"></i></a>
                <a class="btn btn-social-icon btn-dropbox"><i class="fa fa-dropbox"></i></a>
                <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                <a class="btn btn-social-icon btn-flickr"><i class="fa fa-flickr"></i></a>
                <a class="btn btn-social-icon btn-foursquare"><i class="fa fa-foursquare"></i></a>
                <a class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>
                <a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a>
                <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                <a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                <a class="btn btn-social-icon btn-tumblr"><i class="fa fa-tumblr"></i></a>
                <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                <a class="btn btn-social-icon btn-vk"><i class="fa fa-vk"></i></a>
              </div>
            </div>
          </div>
          </div>
    </div><!-- /.row -->
@endsection