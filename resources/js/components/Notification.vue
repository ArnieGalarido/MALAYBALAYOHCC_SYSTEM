<script setup>
import { onMounted, onUnmounted, ref } from 'vue';

const props = defineProps(['user']);
const notifications = ref(props.user.notifications);
const notify_count = ref(props.user.notify_count);
const show_notification = ref(false);

onMounted(() => {
    Echo.channel("channel-notification")
    .listen(".notification-created", res => {
        getNotification();
    });
});

onUnmounted(() => {
    Echo.channel("channel-notification")
    .stopListening(".notification-created");
});

const getNotification = () => {
    axios
    .get('/notifications')
    .then((response) => {
        notifications.value = response.data.notifications;
        notify_count.value = response.data.notify_count;
    })
}

const readNotification = (notification) => {
    if (notification.read) return

    notifications.value.find(n => n.id === notification.id).read = true;
    notify_count.value--;
    axios.get('/notifications/read/'+notification.id);
}
</script>
<template>
    <div class="dropdown mt-2">
        <button @click="show_notification = !show_notification" class="btn btn-sm position-relative" type="button" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bell" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
            </svg>
            <span class="position-absolute badge rounded-pill badge-notification bg-danger">
                {{ notify_count }}
            </span>
        </button>

        <div class="dropdown-menu py-3" :class="{'show': show_notification}">

            <h6 class="dropdown-header px-3"> Notifications </h6>
            <hr class="dropdown-divider"> 
            <div class="dropdown-list w-100 px-0">
                <template v-for="notification in notifications">
                    <div class="item mb-0 py-2" @click="readNotification(notification)">
                        <div class="px-3">
                            <span class="badge bg-success" v-if="notification.details.method === 'Add'">Add</span> 
                            <span class="badge bg-primary" v-else-if="notification.details.method === 'Update'">Update</span> 
                            <span class="badge bg-danger" v-else>Delete</span> 
                            <span :class="{'font-weight-bold': !notification.read}" class="align-middle ml-1">{{ notification.details.title }}</span>
                        </div>
                        <p :class="{'font-weight-bold': !notification.read}" class="px-3 mb-0">{{ notification.details.content }}</p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<style scoped>
.dropdown-menu {
    width: 300px;
}

.dropdown-header {
    color:#12536d;
}
.dropdown-list {
    max-height: 50vh;
    overflow-y: auto;
    overflow-wrap: break-word;
}

.dropdown-list .item {
    cursor: default;
    border-bottom: 1px solid #d2d2d2;
}

.dropdown-list .item:hover {
    background: #e7f5fb;
}
</style>