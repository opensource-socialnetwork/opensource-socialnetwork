.ctyping-hide {
	display:none;	
}
.comments-realtime-status {
	min-height:5px;	
}
.ctyping-c-item {
	margin-top: -30px !important;	
}
.ctyping-c-item-container {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;	
	padding: 10px;
    margin-top: 10px;
    margin-left: -15px;
    margin-right: -15px;
    padding-left: 20px;
    padding-right: 20px;	
}
.ctyping {
	display:inline-block;	
}
.ctyping-text {
	display:inline-block;
    margin-left: 10px;
}
.ctyping-circle {
  display: inline-block;
  height: 6px;
  width: 6px;
  border-radius: 50%;
  background-color: #7d7d7d;
}
.ctyping-circle.ctyping-bouncing {
  animation: ctypingbouncing 1000ms ease-in-out infinite;
  animation-delay: 3600ms;
}
.ctyping-circle:nth-child(1) {
  animation-delay: 0ms;
}

.ctyping-circle:nth-child(2) {
  animation-delay: 333ms;
}

.ctyping-circle:nth-child(3) {
  animation-delay: 666ms;
}

@keyframes ctypingbouncing {
  0% {
    transform: translateY(0);
  }
  33% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-3px);
  }
  100% {
    transform: translateY(0);
  }
}