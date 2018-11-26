package main;

import java.util.ArrayList;
import java.util.Date;
import java.util.TimeZone;

import org.quartz.Job;
import org.quartz.JobDetail;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.quartz.JobKey;
import org.quartz.Scheduler;
import org.quartz.SchedulerException;
import org.quartz.Trigger;
import org.quartz.TriggerBuilder;

import static org.quartz.TriggerBuilder.*;
import static org.quartz.JobBuilder.*;
import static org.quartz.CronScheduleBuilder.*;

import java.sql.*;


public class QueryStarter implements Job {
	// attributes
	ArrayList<String[]> queryList;
	
	/**
	 * Method that should be executed (every 5 minutes, by default) by Quartz
	 */
	public void execute(final JobExecutionContext ctx)
            throws JobExecutionException {
		// initialize the query list
		queryList = new ArrayList<String[]>();
		
		System.out.println("[QUERYSTARTER] Initiating SQL scraping");
		
		// open SQL database connection
		Driver driver;
		try {
			driver = (Driver) Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
			DriverManager.registerDriver(driver);
			Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/jobs", 
					"jobuser", "thissucks");
			conn.setReadOnly(false);
			
			System.out.println("[QUERYSTARTER] Connected to SQL Database");
			
			// list all queries in database
			Statement st = conn.createStatement(ResultSet.TYPE_FORWARD_ONLY, ResultSet.CONCUR_UPDATABLE);
			ResultSet results = st.executeQuery("SELECT * FROM jobs.jobs;");	// please, please check to ensure this makes sense
			
			// move queries from the database to the query list and delete them from the database
			String[] userQueryPair = new String[2];
			while(results.next() == true) {
				userQueryPair[0] = results.getString("user");
				userQueryPair[1] = results.getString("query");
				queryList.add(userQueryPair);
				results.deleteRow();
			}
			
			results.close();
		} catch (InstantiationException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		} catch (IllegalAccessException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		} catch (ClassNotFoundException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		System.out.println("[QUERYSTARTER] Scrape finished");
		
		// connect to current Quartz scheduler
		Scheduler sched = ctx.getScheduler();
		
		// loop through queryList and add all relevant jobs to scheduler
		JobDetail queryJob;
		Trigger querytrigger;
		String queryUser;
		String queryText;
		String nameString;
		String triggerString;
		StringBuilder jobName;
		//Test trigger (start immediately)
		Trigger t1;
		for (String[] queryTuple : queryList) {
			
			// TODO: make Crawler work as a Quartz job (with @DisallowConcurrentExecution ?)
			// TODO: programmatically organize jobs into groups by user and names by number
			
			// this bit organizes jobs into groups by user 
			// and names them based on user and the system time
			queryUser = queryTuple[0];
			queryText = queryTuple[1];
			
			System.out.println("[QUERYSTARTER] Creating job for following query:\t" + queryText);
			
			jobName = new StringBuilder();
			jobName.append(queryUser);
			jobName.append("_queryjob_");
			
			// only millisecond resolution; a server could be fast enough to break this
			Date timestamp = new Date();
			jobName.append(timestamp.getTime());
			
			nameString = jobName.toString();
			
			// create a trigger with a name matching the job name
			jobName.append("_trigger");
			triggerString = jobName.toString();
			t1 = TriggerBuilder.newTrigger().withIdentity(triggerString).startNow().build();
			
			// create new job
			queryJob = newJob(Crawler.class)
					.withIdentity(nameString,queryUser)	// all names temporary
					.usingJobData("queryText",queryText)
					.build();
			// add job to schedule
			try {
				sched.scheduleJob(queryJob, t1);
			} catch (SchedulerException e) {
				e.printStackTrace();
			}
		}
		
		System.out.println("[QUERYSTARTER] Finished with job creation\n");
		
		queryList.clear();
	}
}
