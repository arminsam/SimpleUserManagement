<div v-if="errors.messages" class="alert alert-danger alert-message">
    <button type="button" class="close" v-on="click: errors = {}"><span aria-hidden="true">&times;</span></button>
    <ul class="list-unstyled">
        <li v-repeat="message: errors.messages">@{{ message }}</li>
    </ul>
</div>

<div v-if="success.message" class="alert alert-success alert-message">
    <button type="button" class="close" v-on="click: success = {}"><span aria-hidden="true">&times;</span></button>
    @{{ success.message }}
</div>

<div v-if="warning.message" class="alert alert-warning alert-message">
    <button type="button" class="close" v-on="click: warning = {}"><span aria-hidden="true">&times;</span></button>
    @{{ warning.message }}
</div>
