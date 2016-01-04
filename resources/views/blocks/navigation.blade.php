<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::route( 'home' ) }}">Amazon Products Application</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ $controller == 'CustomersController' ? 'active' : '' }}">
                    <a href="{{ URL::route( 'customers' ) }}">Customers</a>
                </li>
                <li class="{{ $controller == 'TransactionsController' ? 'active' : '' }}">
                    <a href="{{ URL::route( 'transactions' ) }}">Transactions</a>
                </li>
                <li class="{{ $controller == 'TransactionItemsController' ? 'active' : '' }}">
                    <a href="{{ URL::route( 'transaction-items' ) }}">Transaction Items</a>
                </li>
                <li class="{{ $controller == 'AmazonProductsController' ? 'active' : '' }}">
                    <a href="{{ URL::route( 'products' ) }}">Products</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:void(0);">Hi {{ Auth::user()->name }}!</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="logout-user">Logout</a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>