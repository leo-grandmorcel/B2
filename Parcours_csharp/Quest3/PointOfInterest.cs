namespace CSharpDiscovery.Quest03
{
    public class PointOfInterest
    {
        public double Latitude { get; set; }
        public double Longitude { get; set; }
        public string Name { get; set; }
        public static string GoogleMapsUrlTemplate { get; } =
            "https://www.google.com/maps/place/{0}/@{1},{2},15z/";

        public PointOfInterest()
        {
            Latitude = 44.854186;
            Longitude = -0.5663056;
            Name = "Bordeaux Ynov Campus";
        }

        public PointOfInterest(string name, double lat, double longi)
        {
            Latitude = lat;
            Longitude = longi;
            Name = name;
        }

        public string GetGoogleMapsUrl()
        {
            return String.Format(
                GoogleMapsUrlTemplate,
                Name.Replace(" ", "+"),
                Latitude,
                Longitude
            );
        }

        public override string ToString()
        {
            return String.Format("{0} (Lat={1}, Long={2})", Name, Latitude, Longitude);
        }

        public int GetDistance(PointOfInterest other)
        {
            double rlat1 = Math.PI * Latitude / 180;
            double rlat2 = Math.PI * other.Latitude / 180;
            double rtheta = (Longitude - other.Longitude) * Math.PI / 180;
            double dist =
                Math.Sin(rlat1) * Math.Sin(rlat2)
                + Math.Cos(rlat1) * Math.Cos(rlat2) * Math.Cos(rtheta);
            dist = Math.Acos(dist);
            dist = dist * 180 / Math.PI * 60 * 1.1515 * 1.609344;
            return Convert.ToInt32(dist);
        }

        public static int GetDistance(PointOfInterest p1, PointOfInterest p2)
        {
            return p1.GetDistance(p2);
        }
    }
}
