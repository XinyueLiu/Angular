import { Component, OnInit, ViewChild } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  /*
   * Use ViewChild to reference/access our video element 
   * from the view in our component here.
   */
  @ViewChild('myvideo') myVideo: any;

  title = 'app works';

  targetpeer: any;
  peer: any;
  n = <any>navigator;

  ngOnInit() {
    let video = this.myVideo.nativeElement;
    let peerx: any;

    /*
     * We are simply getting the video stream from the device 
     * using navigator.getUserMedia and passing it on in our connection.
     */
    this.n.getUserMedia = (this.n.getUserMedia || this.n.webkitGettUserMedia || this.n.mozGetUserMedia || this.n.msGetUserMedia);
    this.n.getUserMedia({video:true, audio:true}, function(stream) {
      peerx = new SimplePeer ({
        initiator: location.hash === "#init",
        trickle: false,
        stream: stream
      })

      peerx.on('signal', function(data) {
        console.log(JSON.stringify(data));
        this.targetpeer = data;
      })

      peerx.on('data',function(data){
        console.log('Recieved message:' + data);
      })

      peerx.on('stream', function(stream){
        video.src = URL.createObjectURL(stream);
        video.play();
      })

    }, function(err){
      console.log('Failed to get stream', err);
    })

    /*
     * We are using a setTimeout function so that our peer doesn’t go undefined 
     * since this whole operation would happen before the view elements come into picture.
     */
    setTimeout(() => {
      this.peer = peerx;
      console.log(this.peer);
    }, 5000);
  }

  /*
   *The peer.signal is to simply signal the peer to which a connection is to be established, 
   *or rather an ‘offer’ is to be made. When such a signal is made the peer data(JSON format) 
   *is simply logged on to the console.
  */
  connect() {
    this.peer.signal(JSON.parse(this.targetpeer));
  }

  /* 
   *The message function is simply to send a message when a connection is established. 
   *When data is received it is simply logged onto the console again.
  */
  message() {
    this.peer.send('Hello world');
  }
  
}
