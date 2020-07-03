.messagetyping {
}
.mtyping-circle {
  display: inline-block;
  height: 6px;
  width: 6px;
  border-radius: 50%;
  background-color: #7d7d7d;
}
.mtyping-circle.mtyping-bouncing {
  animation: mtypingbouncing 1000ms ease-in-out infinite;
  animation-delay: 3600ms;
}
.mtyping-circle:nth-child(1) {
  animation-delay: 0ms;
}

.mtyping-circle:nth-child(2) {
  animation-delay: 333ms;
}

.mtyping-circle:nth-child(3) {
  animation-delay: 666ms;
}

@keyframes mtypingbouncing {
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