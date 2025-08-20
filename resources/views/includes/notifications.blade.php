@if(session('success'))
<!-- ✅ Notification Container -->
<div class="notifications-stack" style="z-index: 1000"></div>

<!-- ✅ Notification Script -->
<script>
const notificationsStack = document.querySelector(".notifications-stack");
const notifications = [];
let notificationIndex = 0;

function removeLastNotification() {
	const element = notifications.pop();
	if (!element) return;
	element.classList.add("remove");
	setTimeout(() => {
		element.remove();
	}, 400);
}

function createNotification(content) {
	const element = document.createElement("div");
	element.className = "notification";
	element.textContent = content;
	notificationsStack.append(element);
	notifications.push(element);

	setTimeout(() => {
        removeLastNotification();
    }, 8000);
}

// 🚀 Trigger Laravel's success message
createNotification(@json(session('success')));
</script>

<!-- ✅ Notification Styles -->
<style>
    @import url("https://fonts.googleapis.com/css2?family=Neucha:wght@300;400&display=swap");
body { background: #553; }
.notifications-stack {
	position: fixed; top: 2rem; left: 3rem;
}
.notification {
	--line-width: 0.1rem;
	--red: #f003;
	--blue: #00f3;
	--yellow: #dd8;
	user-select: none;
	font-family: "Neucha", cursive;
	letter-spacing: 0.1ch;
	position: absolute;
	min-height: 4rem;
	width: 20rem;
	top: 0;
	left: -50rem;
	rotate: -10deg;
	background-image: linear-gradient(
			transparent 0,
			transparent calc(100% - var(--line-width)),
			var(--blue) calc(100% - var(--line-width)),
			var(--blue) 100%
		),
		linear-gradient(
			to right,
			transparent 0,
			transparent 2rem,
			var(--red) 2rem,
			var(--red) calc(2rem + var(--line-width)),
			transparent calc(2rem + var(--line-width)),
			transparent 100%
		);
	background-size: 100% 1rem;
	background-color: var(--yellow);
	color: #334;
	font-size: 1.5em;
	padding: 0.6rem 3rem;
	display: flex;
	align-items: center;
	border-radius: 0.2rem;
	animation: cubic-bezier(0, 1, 1, 1) slideIn 0.4s forwards;
	text-wrap: pretty;
}
.notification::before {
	content: "";
	position: absolute;
	inset: 0;
	opacity: 1;
	box-shadow: 0 0.5rem 1rem 0.2rem #0003;
	transition: opacity 0.3s ease-in-out;
}
.notification:nth-last-child(-n + 7)::before { opacity: 1; }
.notification::after {
	content: "X";
	display: block;
	position: absolute;
	top: 1rem;
	left: -1rem;
	translate: -50% -50%;
	transition: left 0.2s ease-in-out, opacity 0.1s ease-in-out;
	opacity: 0;
}
.notification:nth-last-child(1) { cursor: pointer; }
.notification:nth-last-child(1):hover::after {
	left: 1rem;
	opacity: 1;
	transition: left 0.2s ease-in-out, opacity 0.1s 0.1s ease-in-out;
}
.notification.remove {
	animation: cubic-bezier(0, 1, 1, 1) slideOut 0.4s forwards;
}
.notification:nth-child(7n) { transform: rotate(-7deg) translate(9%, 6%); }
.notification:nth-child(7n + 1) { transform: rotate(2deg) translate(-1%, 4%); }
.notification:nth-child(7n + 2) { transform: rotate(5deg) translate(10%, -3%); }
.notification:nth-child(7n + 3) { transform: rotate(-3deg) translate(5%, 7%); }
.notification:nth-child(7n + 4) { transform: rotate(1deg) translate(-2%, 17%); }
.notification:nth-child(7n + 5) { transform: rotate(3deg) translate(5%, 4%); }
.notification:nth-child(7n + 6) { transform: rotate(-4deg) translate(-4%, -14%); }
@keyframes slideIn { to { left: 0; rotate: 0deg; } }
@keyframes slideOut { from { left: 0; rotate: 0deg; } to { left: -50rem; rotate: -10deg; } }
</style>

@endif