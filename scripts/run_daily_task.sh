while true; do
  current_time=$(date +%H:%M | tr -d '\n')
  echo "現在時刻: $current_time"  # ログ出力
  if [ "$current_time" = "00:00" ]; then
    echo "タスクを実行します"  # ログ出力
    php /var/www/html/laravel/artisan reset:status
    sleep 60
  else
    echo "条件に合致しなかったら出力"
    sleep 30
  fi
done
