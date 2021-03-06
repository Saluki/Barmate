@extends('layouts.app')

@section('title')

    Barmate POS

@stop

@section('custom-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('build/css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/alertify-js/build/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('build/css/alertify-theme.css') }}" />

@stop

@section('content')

    <!-- APP MAIN CONTAINER -->
    
    <div id="main-container">
        
        <div id="groups-container">
            <div id="groups"></div>
        </div>
        
        <div id="stock"></div>
        
        <div id="ticket-container">

            <div id="ticket">
            
                <div id="ticket-header">
                    <h2>
                        Ticket
                        <button id="clear-ticket" class="btn btn-default pull-right">Clear</button>
                    </h2>
                </div>
                
                <div id="ticket-body"></div>
                
                <div id="ticket-footer" class="clearfix">
                    
                    <div id="ticket-price">0€</div>
                    
                    <button id="pay-ticket" class="btn btn-primary pull-left"><i class="fa fa-check"></i>&nbsp;&nbsp;Pay</button>
                    <button id="free-ticket" class="btn btn-success pull-right"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Free</button>
                    
                </div>
            
            </div>

            <div id="sync-status"></div>

        </div>
        
    </div>
    
    <!-- PAYMENT MODAL -->
    
    <div id="payment-container">
        <div id="payment">
            
            <div id="left-side">
                
                <button class="btn-payment" data-action="1">1</button>
                <button class="btn-payment" data-action="2">2</button>
                <button class="btn-payment" data-action="3">3</button>
                <br>
                <button class="btn-payment" data-action="4">4</button>
                <button class="btn-payment" data-action="5">5</button>
                <button class="btn-payment" data-action="6">6</button>
                <br>
                <button class="btn-payment" data-action="7">7</button>
                <button class="btn-payment" data-action="8">8</button>
                <button class="btn-payment" data-action="9">9</button>
                <br>
                <button class="btn-payment" data-action="." style="background: #ffffff;">,</button>
                <button class="btn-payment" data-action="0">0</button>
                <button class="btn-payment" data-action="R" style="background: #ffffff;">
                    <i class="fa fa-mail-reply" data-action="R"></i>
                </button>

            </div>
            
            <div id="right-side">
                
                <div id="cancel-payment-container" class="clearfix">
                    <div class="btn btn-default btn-xs pull-right" id="cancel-payment">Cancel</div>
                </div>
                
                <b>Paid</b>
                <div id="payment-sum">0€</div>

                <b>Payback</b>
                <div id="payment-rest">0€</div>

                <div class="btn btn-primary btn-block btn-lg" id="send-payment">
                    <i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;Send
                </div>
                
            </div>
            
        </div>
    </div>

@stop

@section('custom-js')

    <!-- TEMPLATES -->
    <script type="text/template" id="template-sync-box">

        <span class="fa fa-warning"></span>&nbsp;&nbsp;

        <%= syncNumber %>

        <% if( syncNumber==1 ) {%>
            sale
        <% } else { %>
            sales
        <% } %> must be synchronized

        <button class="btn btn-danger btn-xl btn-block" id="sync-btn">
            <span class="fa fa-refresh" id="sync-icon"></span>&nbsp;
            Synchronize now
        </button>

    </script>

    <script type="text/template" id="template-stock">

        <% _.each(products, function(product){ %>

            <button class="stock-item" data-id="<%= product.id %>">
                <%= product.get('name') %>
                <div class="stock-item-price">
                    <span class="fa fa-eur"></span> <%= product.get('price') %>
                </div>
            </button>

        <% }) %>

    </script>

    <!-- EXTRA DEPENDENCIES -->
    <script src="{{ asset('bower_components/underscore/underscore.js') }}"></script>
    <script src="{{ asset('bower_components/backbone/backbone.js') }}"></script>
    <script src="{{ asset('bower_components/alertify-js/build/alertify.min.js') }}"></script>

    <!-- RESETTING -->
    <script>
        var serverData = {!! json_encode($stock) !!}
    </script>

    <!-- APPLICATION -->
    <script src="{{ asset('build/js/app.js') }}"></script>

@stop