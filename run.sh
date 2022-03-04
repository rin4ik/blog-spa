#!/bin/sh
​
tmux new-session -d -s 21
​
tmux send-keys 'cd blog-client' Enter
tmux send-keys 'npm run dev' ENTER;
# Split session into FOUR EQUAL quadrants
tmux selectp -t 0    # select the first (0) pane
tmux splitw -h -p 50 # split it into two halves
tmux send-keys 'cd blog-api' Enter
tmux send-keys 'php artisan serve' ENTER;
