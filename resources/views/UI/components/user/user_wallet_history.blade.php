<div class="block-header block-header--has-breadcrumb block-header--has-title">
    <div class="container">
        <div class="block-header__body">
            <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                    <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Wallet History </span>
                    </li>
                    <li class="breadcrumb__title-safe-area" role="presentation"></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="block">
    <div class="container">
        @if(session('msg') != null)
        <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('msg')}}
        </div>
        @endif
        <div class="row">
            @include('UI/components/user/user_sidebar')
            <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                <div class="dashboard">
                    <div class="dashboard__orders card">
                        @if ($wallet->count()>0)
                        <div class="card-header">
                            <h5>Recent 5 Wallet Transactions</h5>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-table">

                            <div class="table-responsive-sm">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Amount</th>
                                            <th>Order Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                        @foreach($wallet as $k=>$r)
                                        <tr>

                                            <td>{{$k+1}} </td>
                                            <td>{{$r->amount}} </td>
                                            <td>
                                                
                                                <b>Payment Id</b> : {{!empty($r->payment_request_id) ? $r->payment_request_id : ''}} <br>
                                                <b>Payment Status</b> : {{!empty($r->payment_status) && $r->payment_status=='success' ? 'Success':'Fail'}} <br>

                                            </td>
                                            <td>{{ date('M j, Y g:i:A', strtotime($r->created_at)) }}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div style="padding:12px">Sorry!! No Transaction found !</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-space block-space--layout--before-footer"></div>