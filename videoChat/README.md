# VideoChat

This is a Angular 2 project, which implements a simple video streaming functionality using the simple-peer library.

# Run the app

1. Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files. Please allow the chrome browser to access your camera and microphone.

2. Open up your browser and navigate to 
http://localhost:4200/#init
![alt text](http://www-scf.usc.edu/~liuxinyu/videochatss/ss1.png)
This will be the initiator peer and if you open up the console you would see the JSON data of that peer. Copy the JSON data.
The data should be like this: {"type":"offer"......"}
![alt text](http://www-scf.usc.edu/~liuxinyu/videochatss/ss3.png)



3. Open a new tab and navigate to 
http://localhost:4200
Paste the JSON data you just copied in the input field and click on connect button. Open up the console and copy the JSON data here too.
The data should be like this: {"type":"answer"......"}
![alt text](http://www-scf.usc.edu/~liuxinyu/videochatss/ss2.png)
![alt text](http://www-scf.usc.edu/~liuxinyu/videochatss/ss4.png)

4. Go back to the first (initiator) tab and paste this in the input field there and click on connect. Now a peer to peer connection is established. To verify the connection. Just click on Send Message button in both the tabs and you would see the message in the console.

5. If everything goes fine you would see a video of yourself in both the tabs when the connection is established.
![alt text](http://www-scf.usc.edu/~liuxinyu/videochatss/ss5.png)
![alt text](http://www-scf.usc.edu/~liuxinyu/videochatss/ss6.png)

Thanks for reading. :)