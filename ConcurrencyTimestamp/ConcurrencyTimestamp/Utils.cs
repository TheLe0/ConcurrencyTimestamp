using System;

namespace ConcurrencyTimestamp
{
    public static class Utils
    {
        public static string GetTimestamp()
        {
            DateTimeOffset _now = DateTime.UtcNow;
            return _now.ToUnixTimeSeconds().ToString();
        }
    }
}
