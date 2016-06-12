class EmailListener
  def user_followed(user_id, follower_id)
    UserMailer.new_follower(user_id, follower_id).deliver_now
  end
end
