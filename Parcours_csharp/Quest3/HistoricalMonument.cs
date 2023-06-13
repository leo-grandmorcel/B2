namespace CSharpDiscovery.Quest03
{
    public class HistoricalMonument : PointOfInterest
    {
        public int BuildYear { get; set; }

        public HistoricalMonument() { }

        public HistoricalMonument(string str, double Lat, double Longi, int BuildY) : base()
        {
            Latitude = Lat;
            Longitude = Longi;
            Name = str;
            BuildYear = BuildY;
        }

        public override string ToString()
        {
            return String.Format("{0} is a historical monument built in {1}", Name, BuildYear);
        }
    }
}
