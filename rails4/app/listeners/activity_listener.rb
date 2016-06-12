class ActivityListener
  def user_followed(user_id, follower_id)
    activity = Activity.new
    activity.action = 'follow'
    activity.from_user_id = follower_id
    activity.to_user_id = user_id
    activity.save
  end

  def user_unfollowed(user_id, follower_id)
    activity = Activity.new
    activity.action = 'unfollow'
    activity.from_user_id = follower_id
    activity.to_user_id = user_id
    activity.save
  end
end
