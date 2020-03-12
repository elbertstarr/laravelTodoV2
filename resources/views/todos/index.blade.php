<!-- 文件首行 -->
@extends('layouts.master')

<!-- 顯示 content 範圍 -->
@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                建立新 Task
            </div>

            <div class="panel-body">
                @if ($errors->any())
                <!-- 錯誤訊息顯示區塊 -->
                <div class="alert alert-danger">
                    <strong>請檢查您輸入的資料！</strong>
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- 建立新 Task 表單 -->
                <form action="{{ url('todos') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <!-- Task 名稱 -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-6">
                            <input type="text" name="title" id="task-name" class="form-control" value="">
                        </div>
                    </div>

                    <!-- 建立新 Task 按鈕 -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i>建立 Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tasks 清單 -->
        <div class="panel panel-default">
            <div class="panel-heading">
                所有 Task 清單
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th width="200">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                        <tr>
                            <td class="table-text">
                                <div class="{{ ($todo->completed)? 'check' : '' }}">{{ $todo->title }}</div>
                            </td>
                            <td>
                                @if (! $todo->completed)
                                <!-- 完成 Task 按鈕 -->
                                <form action="{{ url('todos/'.$todo->id) }}" method="POST" class="form-inline">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i>完成
                                    </button>
                                </form>
                                @endif

                                <!-- 補充 未完成 -->
                                @if ( $todo->completed)
                                <!-- 未完成 Task 按鈕 -->
                                <form action="{{ url('todos/uncomplate/'.$todo->id) }}" method="POST" class="form-inline">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-times"></i>未完成
                                    </button>
                                </form>
                                @endif

                                <!-- 刪除 Task 按鈕 -->
                                <form action="{{ url('todos/'.$todo->id) }}" method="POST" class="form-inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>刪除
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection