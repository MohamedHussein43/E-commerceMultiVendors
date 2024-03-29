<style>

    nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block !important;
    }

</style>
<div class="container" style="padding: 30px 0;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            All Categories
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.addcategory')}}" class="btn btn-success pull-right">Add New</a>
                        </div>
                    </div>
                </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        @if(Session::has('danger'))
                            <div class="alert alert-danger" role="alert">{{Session::get('danger')}}</div>
                        @endif
                        <dir class="board">
                            <table width="100%">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Category Name</td>
                                    <td>Slug</td>
                                    <td>Parent Category</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        @if($category->parent_id)
                                            <td>{{$category->parent_id}}</td>
                                        @else
                                            <td>Root Category</td>
                                        @endif
                                        <td>
                                            <a href="{{route('admin.editcategory',['category_slug'=>$category->slug])}}" style="margin-left: 10px;"><i class="fa fa-edit fa-2x"> </i></a>
                                            <a href={{"/deleteCategory/".$category['id']}}><i class="fa fa-times fa-2x  text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$categories->links()}}

                        </dir>
                    </div>
            </div>
        </div>
    </div>
</div>
