namespace :app do
  desc "app:setup"
  task setup: :environment do
    puts "Run migrations..."
    Rake::Task["db:migrate"].invoke

    puts "Import fixtures..."

    puts "- parse yaml file..."
    user_fixtues = YAML.load_file("#{::Rails.root}/../_shared/users.yml")

    puts "- truncate users table..."
    ActiveRecord::Base.connection.execute("DELETE FROM users")
    ActiveRecord::Base.connection.execute("VACUUM")

    user_fixtues.each do |user_fixture|
      user = User.new

      puts ("- import %s..." % user_fixture['name'])

      user_fixture.each do |k, v|
        # v = ::BCrypt::Password.create(v) if (k == 'password')
        user.method("#{k}=".to_sym).call(v)
      end

      user.save
    end
  end
end
