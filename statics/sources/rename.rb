require 'FileUtils'
require 'digest/md5'

Dir.glob('images/old/**/*') do | filename |
    if File.directory? filename then next end
    path = File.dirname(filename).gsub(/old/, 'new')
    unless File.directory? path then Dir.mkdir path end
    path += '/' + Digest::MD5.hexdigest(File.basename(filename)) + File.extname(filename)
    FileUtils.cp filename, path
    puts '[COPY] ' + path.gsub(/images\/new\//, '')
end