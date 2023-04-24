@extends('backend.app')
@section('content')
<div class="container-fluid h-100 pt-4 px-4">
                <div class="bg-white border-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0 text-secondary">Users</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Sl No.</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td>1</td>
                                    <td>{{$contact->first_name}}</td>
                                    <td>{{$contact->last_name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->company_name}}</td>
                                    <td>{{$contact->mobile_number}}</td>
                                    <td>
                                        <button class="btn text-secondary view" onclick="setMessageValue('{{$contact->email}}', '{{$contact->comment}}')" data-bs-toggle="modal" data-bs-target="#viewMessage">
                                                <i class="fa fa-eye">&nbsp;</i>
                                        </button>
                                        <a class="btn btn-sm btn-secondary" id="sendcontactreply" data-bs-toggle="modal" data-bs-target="#sendMessage"  onclick="setEmailValue(this.getAttribute('data-user-email'))" data-user-email="{{ $contact->email }}" >Send Reply</a>
                                        <!-- <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#sendMessage">Send Message</button> -->
                                        
                                        <form action="{{route('admin.contact.delete',$contact->id)}}" method="post" ><button class="btn text-secondary delete"
                                            onclick="return confirm('are you sure you want to delete?')" type="submit">
                                            @csrf
                                            @method('delete')
                                            <i class="fa fa-trash">&nbsp;</i>

                                            </button></form>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

               <!-- Send Message -->
        <div class="modal fade" id="sendMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="exampleModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Send Reply</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('send-reply') }}" class="row">
                                    @csrf
                                    <div class="col-12 mb-2">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" name="subject" value="{{old('subject')}}" id="subject" required>
                                        <div style = "color:red ; font-size: 10px;" >{{ $errors->first('subject') }}</div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="reply_message">Message</label>
                                        <textarea name="reply_message" value="{{old('reply_message')}}" id="reply_message" cols="30" rows="6" class="form-control" required></textarea>
                                        <div style = "color:red ; font-size: 10px;" >{{ $errors->first('reply_message') }}</div>
                                    </div>
                                    <input type="hidden" name="email_contact" id="email_contact" value= " ">

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-secondary">Send</button>
                                  
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- End Send Message -->
        
        <!-- View Message -->


<div class="modal fade" id="viewMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="viewMessage" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-secondary" id="staticBackdropLabel">Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="row">
                    <div class="col-12 mb-2">
                        <!-- <strong class="d-block">View Message</strong> -->
                        <span>From: <span id="view_contact_email"></span></span>
                    </div>
                    <div class="col-12 mb-2">
                        <p id="view_contact_message"></p>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- End View Message -->

     
@endsection
<script>
    function setMessageValue(email, message) {
        console.log("asdasdas");
    var emailSpan = document.getElementById('view_contact_email');
    var messageSpan = document.getElementById('view_contact_message');
    emailSpan.textContent = email;
    messageSpan.textContent = message;
    }
</script>
<script>
    function setEmailValue(email) {
        document.getElementById('email_contact').value = email;
    }
</script>